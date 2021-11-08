import {
    SET_USER,
    CLEAR_USER,
    SET_MESSAGE
} from "@actions/types";
  
import UserService from "@services/user";
  
export const setUser = () => (dispatch) => {
    return UserService.me().then(
      (data) => {
        dispatch({
          type: SET_USER,
          payload: data,
        });
  
        return Promise.resolve();
      },
      (error) => {
        const message =
          (error.response &&
            error.response.data &&
            error.response.data.message) ||
          error.message ||
          error.toString();
  
        dispatch({
          type: SET_MESSAGE,
          payload: message,
        });
  
        return Promise.reject();
      }
    );
};
  
export const clearUser = () => (dispatch) => {  
    dispatch({
      type: CLEAR_USER,
      payload: { user: null },
    });
};