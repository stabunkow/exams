<template>
	<div class="container" @change="$emit('change', currentValue)">
		<div v-html="content" class="py-4" />
		<div class="pb-1"><span class="label label-default">多选题</span></div>
		<label class="row" v-for="(item, index) in options" :key="item">
			<div class="col-1">
				<input type="checkbox" :value="translateOption(index)" v-model="currentValue" :disabled="hasDone"/>
				<span class="checkbox-core">{{translateOption(index)}}</span>
			</div>
			<div class="col" v-html="item" />
		</label>
		<div v-if="hasDone">
			<p>回答结果：{{replyResult}}</p>
			<p>我的回答：{{replyString}}</p>
			<p>正确答案：{{answer}}</p>
			<p>解析：{{analyse}}</p>
		</div>
	</div>
</template>

<script>
export default {
    props: {
        content: String,
        options: {
            type: Array,
			required: true
		},
		value: Array,
        result: Boolean,
        answer: String,
        analyse: String
	},
	data () {
        return {
            currentValue: this.value
		}
	},
    computed: {
        hasDone () {
            return this.result !== null
        },
        replyResult () {
            return this.result ? '正确' : '错误'
        },
        replyString () {
            return Array.isArray(this.value) ? this.value.sort().join(',') : this.value
        }
    },
	watch: {
        value (val) {
            this.currentValue = val
		},
		currentValue (val) {
            this.$emit('input', val)
		}
	},
	methods: {
        translateOption (index) {
            const trans = ['A', 'B', 'C', 'D', 'E', 'F']
			return trans[index]
		}
	}
}
</script>

<style lang="sass" scoped>
input[type='checkbox']
	display: none
	box-sizing: border-box
	padding: 0
	&:checked + .checkbox-core
		background-color: #26a2ff
		border-color: #26a2ff
		color: #fff
.checkbox-core
	box-sizing: border-box
	display: inline-block
	border-radius: 100%
	border: 1px solid #ccc
	position: relative
	width: 20px
	height: 20px
	line-height: 17px
	text-align: center
</style>