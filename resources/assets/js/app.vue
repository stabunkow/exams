<template>
    <transition name="fade">
        <router-view />
    </transition>
</template>
<script>
import { mapActions } from 'vuex'

export default {
    created () {
        if (jwt.getToken()) {
            this.getAuthUser()
        }
    },
    methods: {
        ...mapActions(['getAuthUser'])
    }
}
</script>