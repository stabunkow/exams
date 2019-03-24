import axios from 'axios'
import jwt from '../helpers/jwt'

const request = axios.create({
    baseURL: '/api/'
})

// 添加认证头
request.interceptors.request.use(config => {
    if (jwt.getToken()) {
        config.headers['Authorization'] = 'Bearer ' + jwt.getToken()
    }
    return config
}, error => Promise.reject(error))

/*
* 创建错误
* 错误码
*   400 - 通用错误
*   401 - 未认证
*   403 - 未授权
*   405 - 方法不被允许
*   404 - 验证错误
*   422 - 表单验证错误
*   500 - 服务器错误
* */

const createHttpError = (code, msg) => {
    const err = new Error(msg)
    err.code = code
    return err
}

// 处理http响应逻辑
const handleResponse = request => {
    return new Promise((resolve, reject) => {
        request.then(resp => {
            const data = resp.data
            resolve(data)
        }).catch(error => {
            console.error(error)
            const resp = error.response
            reject(createHttpError(resp.status, resp.data.message))
        })
    });
}

export default {
    // 公共路由
    createToken (data) {
        return handleResponse(request.post('/authorizations', data))
    },
    updateToken () {
        return handleResponse(request.put('/authorizations/current'))
    },
    getHeadlines () {
        return handleResponse(request.get('/headlines'))
    },
    getSubjectsIncludeSections () {
        return handleResponse(request.get('/subjects?include=sections'))
    },
    getExerciseBooks () {
        return handleResponse(request.get('/exercise_books'))
    },
    // 认证路由
    getAuthUser () {
        return handleResponse(request.get('/user'))
    },
    getExerciseBook (id) {
        return handleResponse(request.get(`/exercise_books/${id}`))
    },
    getExerciseBookIncludeQuestions (id) {
        return handleResponse(request.get(`/exercise_books/${id}?include=questions`))
    },
    updateExerciseBookRecord (id, data) {
        return handleResponse(request.post(`/exercise_books/${id}/record`, data))
    },
    getAuthUserWrongQuestions () {
        return handleResponse(request.get('/user/wrong_questions'))
    },
    getAuthUserFavoriteQuestions () {
        return handleResponse(request.get('/user/favorite_questions'))
    }
}
