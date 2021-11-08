import Storage from "@helpers/Storage";
import {
    SET_USER,
    CLEAR_USER
} from "@actions/types";
  
const user = Storage.get( 'user' );
  
const initialState = user
    ? user
    : null;
  
export default function User (state = initialState, action) {
    const { type, payload } = action;
  
    switch (type) {
        case SET_USER:
            return {
                ...state,
                ...payload,
            };
        case CLEAR_USER:
            return {
                ...state,
                initialState,
            };
        default:
            return state;
    }
}