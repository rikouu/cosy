import { getInfo, login, register, logout } from '@/api/auth'
import { Module, MutationTree, ActionTree, GetterTree, ActionContext } from 'vuex'
import { getToken, removeToken, setToken } from '@/utils/auth'
import { RootState } from '@/store/index'

export interface IUser {
  avatar: string,
  name: string,
  display_name: string,
  url: string,
  id: number
}

export interface IAuthState {
  user?: IUser,
  token?: string,
  roles: Array<string>
}

// state
export const state: IAuthState = {
  user: undefined,
  token: getToken(),
  roles: []
}

export const mutations: MutationTree<IAuthState> = {
  SET_TOKEN: (state: IAuthState, token: string) => {
    setToken(token)
    state.token = token
  },
  LOGOUT: (state: IAuthState) => {
    state.token = undefined
    state.roles = []
    /// 防止个人头像退出的瞬间获取不到
    setTimeout(() => {
      state.user = undefined
    }, 100)
    removeToken()
  },
  SET_ROLES: (state: IAuthState, roles) => {
    state.roles = roles
  },
  UPDATE_USER: (state: IAuthState, user: IUser | object) => {
    state.user = <IUser>user
  }
}

export const actions: ActionTree<IAuthState, RootState> = {
  // 将刷新的 token 保存至本地
  RefreshToken (context: ActionContext<IAuthState, RootState>, token: string) {
    context.commit('SET_TOKEN', token)
  },
  // 注册
  Register (context: ActionContext<IAuthState, RootState>, userInfo: any) {
    return new Promise((resolve, reject) => {
      register(userInfo).then((res: any) => {
        const { data } = res.data

        if (data.token) {
          context.commit('SET_TOKEN', data.token)
          resolve(res)
        } else {
          reject(res.data.errors)
        }
      }).catch((error: Error) => {
        reject(error)
      })
    })
  },
  // 登录
  Login (context: ActionContext<IAuthState, RootState>, userInfo: any) {
    return new Promise((resolve, reject) => {
      login(userInfo).then((res: any) => {
        const { data, errors } = res.data

        if (data && data.token) {
          context.commit('SET_TOKEN', data.token)
          resolve(res)
        } else {
          reject(errors)
        }
      }).catch((error: Error) => {
        reject(error)
      })
    })
  },
  // 获取用户信息
  GetInfo (context: ActionContext<IAuthState, RootState>) {
    return new Promise((resolve, reject) => {
      getInfo().then(res => {
        const { data } = res.data

        // 验证返回的roles是否是一个非空数组
        if (data && data.roles && data.roles.length > 0) {
          context.commit('SET_ROLES', data.roles)
        } else {
          reject(new Error(data.errors))
        }

        context.commit('UPDATE_USER', data)

        resolve(res.data)
      }).catch(error => {
        reject(error)
      })
    })
  },
  // 登出
  Logout (context: ActionContext<IAuthState, RootState>) {
    return new Promise((resolve, reject) => {
      logout().then(() => {
        context.commit('LOGOUT')
        resolve()
      }).catch(() => {
        context.commit('LOGOUT')
        resolve()
      })
    })
  }
}

export const getters: GetterTree<IAuthState, RootState> = {
  user: state => state.user,
  check: state => state.user != null,
  token: state => state.token,
  roles: state => state.roles
}

const auth: Module<IAuthState, RootState> = {
  namespaced: true,
  state: state,
  actions: actions,
  mutations: mutations,
  getters: getters
}

export default auth
