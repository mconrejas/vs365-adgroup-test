import update from 'react-addons-update';
import {
    ADD_IP_ITEM,
    CLEAR_IP_ITEM,
    SET_IP_ITEM,
    SET_IP_ITEMS,
    UPDATE_IP_ITEM
} from "@actions/types";
  
const initialState = {
    items: {},
    item: {}
};
  
export default function Ip (state = initialState, action) {
    const { type, payload } = action;

    switch (type) {
        case ADD_IP_ITEM:
            return update(state, {
                items: {
                    data: {$push: [payload]}
                }
            });
        case SET_IP_ITEMS:
            return {
                ...state,
                items: payload,
            };
        case SET_IP_ITEM:
            return {
                ...state,
                item: payload,
            };
        case UPDATE_IP_ITEM:
            console.log( state.items )
            const index = state.items?.data.findIndex(o => o.id === payload.id)

            return update(state, {
                item: {$set: payload},
                // items: { 
                //   data: {
                //     [index]: {$set: payload}
                //   }
                // }
            });
        case CLEAR_IP_ITEM:
            return {
                ...state,
                item: {},
            };
        default:
            return state;
    }
}