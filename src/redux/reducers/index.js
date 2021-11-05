import { combineReducers } from "redux";
import Auth from "@reducers/auth";
import Comment from "@reducers/comment";
import Ip from "@reducers/ip";
import User from "@reducers/user";

const reducer = combineReducers({
    Auth,
    Comment,
    Ip,
    User,
});

export default reducer;