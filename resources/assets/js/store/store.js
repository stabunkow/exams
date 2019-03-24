import Vuex from 'vuex'

import model from '../model/model'
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
            async createToken ({commit, dispatch}, reqData) {
                try {
                    const respData = await model.createToken(reqData)
                    jwt.setToken(respData.token)
                    dispatch('getAuthUser')
                } catch (error) {
                    jwt.removeToken()
                    commit('unsetAuthUser')
                }
            },
            async updateToken ({commit, dispatch}) {
                try {
                    const respData = await model.updateToken()
                    jwt.setToken(respData.token)
                    await dispatch('getAuthUser')
                    return true
                } catch (error) {
                    this.clearAuthUser()
                    return false
                }
            },
            clearAuthUser({commit}) {
                jwt.removeToken()
                commit('unsetAuthUser')
            },
            async getSubjectsIncludeSections () {
                return await model.getSubjectsIncludeSections()
            },
            async getExerciseBooks () {
                return await model.getExerciseBooks()
            },
            async getHeadlines () {
                return await model.getHeadlines()
            },
            // 需要认证的动作
            async getAuthUser ({commit, dispatch}) {
                try {
                    const respData = await model.getAuthUser()
                    commit('setAuthUser', respData)
                } catch (error) {
                    if (jwt.getToken()) {
                        await dispatch('updateToken')
                    } else {
                        this.clearAuthUser()
                    }
                }
            },
            async getExerciseBook({dispatch}, id) {
                try {
                    return await model.getExerciseBook(id)
                } catch (error) {
                    if (error.code === 401 && jwt.getToken()) {
                        if (await dispatch('updateToken')) {
                            return await this.getExerciseBook(id)
                        }
                    }
                    throw error
                }
            },
            async getExerciseBookIncludeQuestions ({dispatch}, id) {
                try {
                    return await model.getExerciseBookIncludeQuestions(id)
                } catch (error) {
                    if (error.code === 401 && jwt.getToken()) {
                        if (await dispatch('updateToken')) {
                            return await this.getExerciseBookIncludeQuestions(id)
                        }
                    }
                    throw error
                }
            },
            async updateExerciseBookRecord ({dispatch}, {id, record}) {
                try {
                    return await model.updateExerciseBookRecord(id, {record})
                } catch (error) {
                    if (error.code === 401 && jwt.getToken()) {
                        if (await dispatch('updateToken')) {
                            return await this.updateExerciseBookRecord(id, record)
                        }
                    }
                    throw error
                }
            },
            async getAuthUserWrongQuestions ({dispatch}) {
                try {
                    return await model.getAuthUserWrongQuestions()
                } catch (error) {
                    if (error.code === 401 && jwt.getToken()) {
                        if (await dispatch('updateToken')) {
                            return await this.getAuthUserWrongQuestions()
                        }
                    }
                    throw error
                }
            }
        },
        modules: {
            AuthUser
        }
    })
}