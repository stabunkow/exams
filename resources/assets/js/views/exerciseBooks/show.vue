<template>
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <h1 class="lead">{{exerciseBook.title}}</h1>
                <small>{{exerciseBook.section.name}}</small>
                <p>{{exerciseBook.description}}</p>
                <p v-show="exerciseBook.questions_count">{{exerciseBook.questions_count}}道题</p>
                <p v-show="exerciseBook.price">售价:{{exerciseBook.price}}元</p>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    data () {
        return {
            exerciseBook: {
                section: {}
            }
        }
    },
    created () {
        this.init()
    },
    methods: {
        ...mapActions(['getExerciseBook']),
        async init () {
            this.exerciseBook = await this.getExerciseBook(this.$route.params.id)
        }
    }
}
</script>