import { SET_MESSAGE, CLEAR_MESSAGE } from "@actions/types";

const initialMessageState = {
    message: ""
};

export default function Notification (state = initialMessageState, action) {
    const { type, payload } = action;

    switch (type) {
        case SET_MESSAGE:
            return { message: payload };

        case CLEAR_MESSAGE:
            return { message: "" };

        default:
            return state;
    }
}