import Vuex from 'vuex'

import AuthUser from './modules/authUser'

export default () => {
    return new Vuex.Store({
        mutations: {
            setAuthUser (state, payload) {
                state.AuthUser.authenticated = true
                state.AuthUser.id = payload.id
                state.AuthUser.email = payload.email
                state.AuthUser.phone = payload.phone
                state.AuthUser.name = payload.name
            },
            unsetAuthUser (state) {
                state.AuthUser.authenticated = false
                state.AuthUser.id = null
                state.AuthUser.email = null
                state.AuthUser.phone = null
                state.AuthUser.name = null
            }
        },
        actions: {
            async login ({commit, dispatch}, formData) {
                try {
                    const token = await axios.post('/api/authorizations', formData)
                    jwt.setToken(token.data.token)
                    dispatch('getAuthUser')
                } catch (e) {
                    jwt.removeToken()
                    commit('unsetAuthUser')
                }
            },
            async getAuthUser ({commit, dispatch}) {
                try {
                    const user = await axios.get('/api/user')
                    commit('setAuthUser', user.data)
                } catch (e) {
                    if (jwt.getToken()) {
                        await dispatch('refreshToken')
                    } else {
                        commit('unsetAuthUser')
                    }
                }
            },
            async refreshToken ({commit, dispatch}) {
                try {
                    const token = await axios.put('/api/authorizations/current')
                    jwt.setToken(token.data.token)
                    await dispatch('getAuthUser')
                } catch (e) {
                    jwt.removeToken()
                    commit('unsetAuthUser')
                }
            },
            async getExerciseBook({}, id) {
                const exerciseBook = await axios.get('/api/exercise_books/' + id)
                return exerciseBook.data
            },
            async getHeadlines () {
                const headlines = await axios.get('/api/headlines')
                return headlines.data
            }
        },
        modules: {
            AuthUser
        }
    })
}