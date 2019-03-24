<template>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">登录</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right">用户名</label>
                            <div class="col-md-6">
                                <input id="username"
                                       type="text"
                                       class="form-control"
                                       name="email"
                                       v-model="username"
                                       required
                                       autofocus>
                                <span class="invalid-feedback">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">密码</label>

                            <div class="col-md-6">
                                <input id="password"
                                       type="password"
                                       class="form-control"
                                       v-model="password"
                                       name="password"
                                       required>
                                <span class="invalid-feedback">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-primary"
                                    @click="sendLoginForm"
                                >
                                    登录
                                </button>

                                <a class="btn btn-link" href="/password/reset">
                                    忘记密码？
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {
    mapActions
} from 'vuex'

export default {
    data () {
        return {
            username: null,
            password: null
        }
    },
    methods: {
        ...mapActions(['createToken']),
        sendLoginForm () {
            this.createToken({
                username: this.username,
                password: this.password
            })
        }
    }
}
</script>