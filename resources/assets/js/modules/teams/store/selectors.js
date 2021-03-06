import * as fromReducer from "./reducer";

export const getTeams = state => fromReducer.getTeams(state.teamState);

export const getTeam = (state, id) => fromReducer.getTeam(state.teamState, id);

export const getSearchStringForTeams = state =>
  fromReducer.getSearchStringForTeams(state.teamState);

export const getPaginationForTeams = state =>
  fromReducer.getPaginationForTeams(state.teamState);
