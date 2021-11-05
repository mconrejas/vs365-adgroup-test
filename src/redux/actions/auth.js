import { LOGIN_SUCCESS, LOGOUT } from "@actions/types";
import { toast } from 'react-toastify';
import AuthService from "@services/auth";
import Storage from "@helpers/Storage";
  
export const login = (username, password) => (dispatch) => {
    return AuthService.login(username, password).then(
      (response) => {
        const { data } = response;

        Storage.set('auth', data);

        dispatch({
          type: LOGIN_SUCCESS,
          payload: data,
        });

        toast.success( 'Login successful!' )
  
        return Promise.resolve();
      },
      (error) => {
        const message =
          (error.response &&
            error.response.data &&
            error.response.data.message) ||
          error.message ||
          error.toString();

        toast.error( error.response.status === 401 ? 'Invalid email or password!' : message )
  
        return Promise.reject();
      }
    );
};
  
export const logout = () => (dispatch) => {
    AuthService.logout();
  
    dispatch({
      type: LOGOUT,
    });
};