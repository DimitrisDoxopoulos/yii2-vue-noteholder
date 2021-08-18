/** Default config for axios instance */
import axios from "axios";
import authService from "./auth.service";
import router from "../router";

const API_ENDPOINT = process.env.VUE_APP_API_ENDPOINT || 'http://localhost:8080';
let config = {
    baseURL: `${API_ENDPOINT}/api/`
};

/** Creating the instance for axios */
const httpClient = axios.create(config);

/** Auth token interceptors */
const authInterceptor = config => {
    config.headers.Authorization = `Bearer ${authService.getToken()}`;
    return config;
}

/** Adding the request interceptors */
httpClient.interceptors.request.use(authInterceptor);

/**Adding the responce interceptors */
httpClient.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response.status === 401) {
            router.push({name: 'login'});
        }

        return Promise.reject(error);
    }
);

export default httpClient;