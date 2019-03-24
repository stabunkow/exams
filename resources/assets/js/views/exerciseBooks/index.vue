<template>
    <div class="row justify-content-center">
        <div class="col-md-8 py-4">
            <div class="container">
                <mt-picker :slots="subjectsSlots"
                           @change="onSlotsChange"
                           :visible-item-count="5" />
                <p class="text-center">{{section}}</p>
                <button class="btn btn-block">查询</button>
                <div class="container py-4">
                    <ul class="list-unstyled">
                        <li v-for="{id, title, price, description, section, updated_at} in exerciseBooks">
                            <div class="card">
                                <div class="card-body">
                                    <h5>{{title}}</h5>
                                    <small>{{section.name}}</small>
                                    <p>{{description}}</p>
                                    <div class="clearfix">
                                        <router-link class="btn-sm"
                                                         :to="{name:'exerciseBookQuestions', params: { id: id } }">答题</router-link>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex'

export default {
    data () {
        return {
            subjects: [],
            subjectsSlots: [
                {
                    flex: 1,
                    values: [],
                    className: 'slot1',
                    textAlign: 'center'
                },
                {
                    divider: true,
                    content: '-',
                    className: 'slot2'
                },
                {
                    flex: 1,
                    values: [],
                    className: 'slot3',
                    textAlign: 'center'
                }
            ],
            section: null,
            exerciseBooks: []
        }
    },
    mounted () {
        this.init()
    },
    methods: {
        ...mapActions([
            'getSubjectsIncludeSections',
            'getExerciseBooks'
        ]),
        async init () {
            this.subjects = await this.getSubjectsIncludeSections()
            this.subjectsSlots[0].values = this.subjects.map(subject => subject.name)
            this.subjectsSlots[2].values = this.subjects[0].sections.map(section => section.name)

            const exerciseBooks = await this.getExerciseBooks()
            this.exerciseBooks = exerciseBooks.data
        },
        onSlotsChange (picker, values) {
            if (this.subjects.length) {
                const subject = _.find(this.subjects, { name: values[0] })
                const sections = subject.sections.map(section => section.name)
                picker.setSlotValues(1, sections)
                this.section = values[1]
            }
        }
    }
}
</script>

<style lang="sass" scoped>
.card
    margin-top: 10px
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2)
    &:hover
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2)
</style>