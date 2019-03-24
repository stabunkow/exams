<template>
	<div>
		{{wrongQuestions}}
	</div>
</template>

<script>
import {mapActions} from 'vuex'

export default {
    data () {
        return {
            wrongQuestions: []
		}
	},
	created () {
		this.init()
	},
	methods: {
        ...mapActions([
            'getAuthUserWrongQuestions'
		]),
        async init() {
            this.wrongQuestions = await this.getAuthUserWrongQuestions()
        }
	}
}
</script>