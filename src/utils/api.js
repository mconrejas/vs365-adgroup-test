import axios from 'axios';
import Auth from "helpers/Storage";

const instance = axios.create({
  baseURL: `http://localhost:8000/api/`,
  headers: {
    "Content-Type": "application/json",
  }
});

instance.interceptors.request.use(
  (config) => {
    const token = Auth.get('auth');

    if (token) {
      config.headers["Authorization"] = 'Bearer ' + token.access_token;
    }

    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

instance.interceptors.response.use(
  (res) => {
    return res;
  },
  async (err) => {
    const originalConfig = err.config;

    if (originalConfig.url !== "auth/login" && err.response) {
      
      // Access Token was expired
      if (err.response.status === 401 && Auth.get('auth')) {
        try {
          const rs = await instance.post("auth/refreshtoken");
          Auth.set('auth', rs.data);

          // return instance(originalConfig);
        } catch (_error) {
          alert("Session expired, please login.")
          window.location.href = '/login';
        }
      }
    }

    return Promise.reject(err);
  }
);

export default instance;