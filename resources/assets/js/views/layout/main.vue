<template>
    <div>
        <Header></Header>
        <transition name="fade">
            <router-view />
        </transition>
    </div>
</template>
<script>
import Header from './header'

export default {
    components: {
        Header
    }
}
</script>