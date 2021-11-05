import Storage from "@helpers/Storage";
import {
    LOGIN_SUCCESS,
    LOGIN_FAIL,
    LOGOUT,
} from "@actions/types";
  
const auth = Storage.get( 'auth' );
  
const initialState = auth
    ? auth
    : null;
  
export default function Auth (state = initialState, action) {
    const { type, payload } = action;
  
    switch (type) {
        case LOGIN_SUCCESS:
            return {
                ...state,
                ...payload,
            };
        case LOGIN_FAIL:
            return {
                ...state,
                initialState,
            };
        case LOGOUT:
            return {
                ...state,
                initialState,
            };
        default:
            return state;
    }
}