<template>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div id="headlines" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                    <li data-target="#headlines"
                        v-for="({title}, index) in headlines"
                        :key="title"
                        :class="{active: index === 0}"
                        :data-slide-to="index" />
                </ul>

                <div class="carousel-inner">
                    <div class="carousel-item text-center"
                         v-for="({title, image}, index) in headlines"
                         :key="title"
                         :class="{active: index === 0}"
                    >
                        <img class="img-fluid"
                             :src="image" :alt="title"/>
                    </div>
                </div>

                <a class="carousel-control-prev" href="#headlines" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#headlines" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
            <div class="jumbotron">
                <div class="container">
                    <h1>离研究生考试</h1>
                    <h4><span class="display-1">{{ leftDays }}</span>天</h4>
                </div>
            </div>
            <div class="jumbotron bg-info">
                <div class="container">
                    <h1 class="float-right">答题册</h1>
                    <h4 class="clearfix"><span class="display-4 float-right">助你一战</span></h4>
                    <h3 class="clearfix"><span class="display-1 float-right">GO</span></h3>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    data () {
        return {
            headlines: []
        }
    },
    created () {
        this.init()
    },
    computed: {
        leftDays () {
            const leftTime = new Date('2018-12-23') - Date.now()
            const leftDays = Math.floor((leftTime / (24*3600*1000)))
            return leftDays
        }
    },
    methods: {
        ...mapActions(['getHeadlines']),
        async init () {
            const headlines = await this.getHeadlines()
            this.headlines = headlines
        }
    }
}
</script>

<style lang="sass" scoped>
.carousel-inner
    background-color: #d6d8d9
.row
    margin: 0
.col-md-8
    padding: 0
.jumbotron
    margin-bottom: 0
</style>