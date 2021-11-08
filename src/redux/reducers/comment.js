import update from 'react-addons-update';
import {
    ADD_COMMENT_ITEM,
    CLEAR_COMMENT_ITEM,
    CLEAR_COMMENT_ITEMS,
    SET_COMMENT_ITEMS,
    SET_COMMENT_ITEM,    
    UPDATE_COMMENT_ITEM
} from "@actions/types";
  
const initialState = {
    items: [],
    item: {}
};
  
export default function Comment (state = initialState, action) {
    const { type, payload } = action;
  
    switch (type) {
        case ADD_COMMENT_ITEM:
            return update(state, {
                items: {$push: [payload]}
            });
        case SET_COMMENT_ITEMS:
            return {
                ...state,
                items: payload,
            };
        case SET_COMMENT_ITEM:
            return {
                ...state,
                item: payload,
            };
        case UPDATE_COMMENT_ITEM:
            const index = state.items.findIndex(o => o.id === payload.id)
            return update(state, {
                item: {$set: payload},
                items: { 
                    [index]: {$set: payload}
                }
            });
        case CLEAR_COMMENT_ITEM:
            return {
                ...state,
                item: {},
            };
        case CLEAR_COMMENT_ITEMS:
            return {
                ...state,
                items: [],
            };
        default:
            return state;
    }
}