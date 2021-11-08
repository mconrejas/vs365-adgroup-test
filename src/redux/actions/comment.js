import {
    ADD_COMMENT_ITEM,    
    UPDATE_COMMENT_ITEM
} from "@actions/types";
import { toast } from 'react-toastify';
import CommentService from "@services/comment";
  
export const save = (ip_id, comment) => (dispatch) => {
    return CommentService.save(ip_id, comment).then(
        (response) => {
            const { data: { data } } = response;

            dispatch({
                type: ADD_COMMENT_ITEM,
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

            if ( Object.keys(error.response.data.errors).length > 0 ) {
                toast.error( Object.values(error.response.data.errors).join(' ') )
            } else {
                toast.error( message )
            }
    
            return Promise.reject();
        }
    );
};

export const update = (id, comment) => (dispatch) => {
    return CommentService.update(id, comment).then(
        (response) => {
            const { data: { data } } = response;

            dispatch({
                type: UPDATE_COMMENT_ITEM,
                payload: data,
            });

            toast.success( 'Comment successfully updated.' )
    
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