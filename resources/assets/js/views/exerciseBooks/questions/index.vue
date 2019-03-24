<template>
    <div @mousedown.prevent="touchStart" @mouseup.prevent="touchEnd">
        <nav class="navbar navbar-light navbar-laravel">
            <div class="container text-center" style="padding: 0">
                <button class="btn btn-light float-left" onclick="history.back()">
                    <octicon name="chevron-left"></octicon>
                </button>
                <div class="text-truncate">{{exerciseBookTitle}}</div>
                <button class="btn btn-light float-right" @click="centerVisiable = true">
                    <octicon name="repo-push"></octicon>
                </button>
            </div>
        </nav>
        <div class="container text-center d-flex justify-content-between align-items-center pt-2" v-if="watching !== null">
            <button class="btn btn-outline-dark btn-sm" @click="prevPage">上一页</button>
            <span>{{ watching + 1 }} / {{ this.questions.length }}</span>
            <button class="btn btn-outline-dark btn-sm" @click="nextPage">下一页</button>
        </div>
        <transition name="fade" mode="out-in">
            <component v-if="watching !== null"
                       v-bind:is="componentType"
                       :key="watching"
                       v-model="questions[watching].reply"
                       :answer="questions[watching].answer"
                       :analyse="questions[watching].analyse"
                       :result="questions[watching].result"
                       :content="questions[watching].content"
                       :options="questions[watching].options" />
        </transition>
        <mt-popup v-model="resultVisiable" position="right" class="result-popup">
            <div class="container result-popup-container" v-if="resultVisiable">
                <p>答正数：{{questions.length - wrongCount}}</p>
                <p>答错数：{{wrongCount}}</p>
                <p>总题数：{{questions.length}}</p>
                <p>错题：{{wrongIndexes}}</p>
                <mt-button @click.native="resultVisiable = false" size="large" type="primary">关闭</mt-button>
            </div>
        </mt-popup>
        <mt-popup v-model="centerVisiable" position="bottom" class="center-popup container pb-2">
            <div v-if="centerVisiable">
                <div class="row col-12 container d-flex justify-content-between align-items-center pt-2">
                <button class="btn btn-light">
                    <octicon name="star" />收藏
                </button>
                <span>当前:{{ watching + 1 }} | 总答:{{ finishedCount }}</span>
                </div>
                <div class="row">
                    <div class="col-3 d-flex flex-wrap text-center"
                         v-for="(question, index) in questions" :key="index">
                        <div class="click-jump my-3" :class="{'has-done': question.reply.length !== 0}">
                            {{ index + 1 }}
                        </div>
                    </div>
                </div>
                <mt-button size="large" type="primary" @click="beforeSubmit">提交</mt-button>
            </div>
        </mt-popup>
    </div>
</template>

<script>
import Single from './components/single'
import Multiple from './components/multiple'
import { mapActions } from 'vuex'
import { Indicator, Toast, MessageBox } from 'mint-ui'
import Octicon from "vue-octicon/components/Octicon";

export default {
    components: {
        Octicon,
        Single,
        Multiple
    },
    data () {
        return {
            exerciseBookTitle: null,
            questions: [],
            watching: null,
            touch: {
                startX: null,
                endX: null
            },
            resultVisiable: false,
            centerVisiable: false
        }
    },
    created () {
        this.init()
    },
    computed: {
        componentType () {
            if (this.watching !== null) {
                let type = this.questions[this.watching].type
                return type === 1 ? 'Single' : 'Multiple'
            }
            return null
        },
        finishedCount () {
            return this.questions.filter(question => {
                return question.reply.length !== 0 ? true : false
            }).length
        },
        wrongCount () {
            return this.questions.filter((question) => {
                return !question.result
            }).length
        },
        wrongIndexes () {
            return this.questions.filter((question) => {
                return !question.result
            }).map((question, index) => {
                return index + 1
            }).join(',')
        }
    },
    methods: {
        ...mapActions([
            'getExerciseBookIncludeQuestions',
            'updateExerciseBookRecord'
        ]),
        async init () {
            try {
                Indicator.open()
                let exerciseBook = await this.getExerciseBookIncludeQuestions(this.$route.params.id)
                this.exerciseBookTitle = exerciseBook.title
                this.questions = exerciseBook.questions
                this.questions.forEach((question) => {
                    question.reply = question.type === 1 ? "" : []
                    question.result = null
                })
                this.watching = 0
            } catch (e) {
                console.error(e)
                if (e.code === 401) {
                    Toast('未登录')
                } else if (e.code === 403) {
                    Toast('未购买')
                } else {
                    Toast('加载失败')
                }
            } finally {
                Indicator.close()
            }
        },
        touchStart (e) {
            this.touch.startX = e.pageX
        },
        touchEnd (e) {
            this.touch.endX = e.pageX
            this.slide()
        },
        slide () {
            if (this.touch.startX && this.touch.endX) {
                if (this.touch.endX - this.touch.startX > 100) {
                    this.prevPage()
                } else if (this.touch.endX - this.touch.startX < -100) {
                    this.nextPage()
                }
            }
        },
        nextPage () {
            if (this.watching < this.questions.length - 1) {
                this.watching++
            } else {
                Toast('已经到底啦')
            }
        },
        prevPage () {
            if (this.watching > 0) {
                this.watching--
            } else {
                Toast('这是第一页')
            }
        },
        beforeSubmit () {
            if (this.finishedCount < this.questions.length) {
                MessageBox.confirm('尚有题目未完成，确认提交？', '提示').then(action => {
                    if (action) {
                        this.submit()
                    }
                })
            } else {
                this.submit()
            }
        },
        submit () {
            let record = []
            this.questions.forEach((question) => {
                let reply = question.type === 1 ? question.reply : question.reply.sort().join(',')
                let result = reply === question.answer ? true : false
                question.result = result
                if (! result) {
                    record.push(question.id)
                }
            })
            if (record.length) {
                let id = this.$route.params.id
                this.updateExerciseBookRecord({id, record})
            }
            this.resultVisiable = true
            console.log(record)
            let watching = this.watching
            this.watching = watching
        }
    }
}
</script>

<style lang="sass" scoped>
.container-item
    min-height: 600px
    overflow: scroll
.result-popup
    width: 100%
    height: 100%
    background-color: #fff
.result-popup-container
	position: absolute
	top: 50%
	transform: translateY(-50%)
.center-popup
    width: 100%
.click-jump
    border: 1px solid #4e555b
    width: 30px
    height: 30px
    border-radius: 100%
.has-done
    background-color: #26a2ff
    color: #ffffff
    border: 1px solid #26a2ff
</style>