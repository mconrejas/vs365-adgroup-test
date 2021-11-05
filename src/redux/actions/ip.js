import {
    ADD_IP_ITEM,
    SET_IP_ITEMS,
    SET_IP_ITEM,
    UPDATE_IP_ITEM,
    SET_COMMENT_ITEMS,
} from "@actions/types";
import { toast } from 'react-toastify';
import IpService from "@services/ip";
  
export const all = (page, limit) => (dispatch) => {
    return IpService.all(page, limit).then(
        (response) => {
            const { data } = response;

            dispatch({
                type: SET_IP_ITEMS,
                payload: data,
            });
    
            return Promise.resolve();
        },
        (error) => {

            toast.error( 'Something went wrong, unable to fetch data.' )
    
            return Promise.reject();
        }
    );
};

export const get = (id) => (dispatch) => {
    return IpService.get(id).then(
        (response) => {
            const { data: { data } } = response;

            dispatch({
                type: SET_IP_ITEM,
                payload: data,
            });

            dispatch({
                type: SET_COMMENT_ITEMS,
                payload: data.comments,
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

            toast.error( message )
    
            return Promise.reject();
        }
    );
};

export const saveIp = (ip, label) => (dispatch) => {
    return IpService.save(ip, label).then(
        (response) => {
            const { data: { data } } = response;

            dispatch({
                type: ADD_IP_ITEM,
                payload: data,
            });

            dispatch({
                type: SET_IP_ITEM,
                payload: data,
            });

            toast.success( 'IP successfully saved.' )
    
            return Promise.resolve();
        },
        (error) => {
            const message =
            (error.response &&
                error.response.data &&
                error.response.data.message) ||
            error.message ||
            error.toString();

            if ( Object.keys(error.response.data.errors).length > 0 ) {
                toast.error( Object.values(error.response.data.errors).join(' ') )
            } else {
                toast.error( message )
            }
    
            return Promise.reject();
        }
    );
};

export const updateIp = (id, label) => (dispatch) => {
    return IpService.update(id, label).then(
        (response) => {
            const { data: { data } } = response;

            dispatch({
                type: UPDATE_IP_ITEM,
                payload: data,
            });

            toast.success( 'IP successfully updated.' )
    
            return Promise.resolve();
        },
        (error) => {
            const message =
            (error.response &&
                error.response.data &&
                error.response.data.message) ||
            error.message ||
            error.toString();

            if ( Object.keys(error.response.data.errors).length > 0 ) {
                toast.error( Object.values(error.response.data.errors).join(' ') )
            } else {
                toast.error( message )
            }
    
            return Promise.reject();
        }
    );
};