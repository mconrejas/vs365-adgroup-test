import API from "utils/api";
import Storage from "@helpers/Storage";

class AuthService {
    async login(email, password) {
        return await API.post("auth/login", { email, password })
    }

    async logout() {
        return await API
        .post("auth/logout")
        .then(() => {
            Storage.remove("auth")
            Storage.remove("user")
        })
    }
}

export default new AuthService();