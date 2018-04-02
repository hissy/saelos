import * as fromReducer from './reducer'
import * as fromFieldReducer from '../../fields/store/reducer'
import _ from 'lodash'

export const getUsers = (state) =>
  fromReducer.getUsers(state.userState)

export const getUser = (state, id) =>
  fromReducer.getUser(state.userState, id)

export const getSearchStringForUsers = (state) =>
  fromReducer.getSearchStringForUsers(state.userState)

export const getPaginationForUsers = (state) =>
  fromReducer.getPaginationForUsers(state.userState)

export const getFieldsForUsers = (state) =>
  _.filter(fromFieldReducer.getFields(state.fieldState), f => f.model === 'App\\User')