import API from "utils/api";
import Storage from "@helpers/Storage";
import { toast } from 'react-toastify';

class UserService {
    async me() {
        return await API
        .get("auth/me")
        .then((response) => {
            if (response) {
                Storage.set('user', response.data);
            }
    
            return response.data;
        })
        .catch(error => toast.error( error.response.message ));
    }
}

export default new UserService();