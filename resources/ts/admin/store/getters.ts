
import { Module, MutationTree, ActionTree, GetterTree, ActionContext } from 'vuex'
import { RootState } from './index'

const getters = {
  device: (state: RootState) => state.theme.device,
  locale: (state: RootState) => state.app.locale,
  color: (state: RootState) => state.theme.color,
  // token: (state: RootState)  => state.user.token,
  // avatar: (state: RootState)  => state.user.avatar,
  // welcome: (state: RootState)  => state.user.welcome,
  roles: (state: RootState) => state.auth.roles
  // addRouters: (state: RootState) => state.permission.addRouters,
}

export default getters
