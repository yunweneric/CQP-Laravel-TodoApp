const axios = window.axios;
const BaseUrl = 'http://localhost:8000/api';
export default {
    getAllTodos() {
        axios.get(`${BaseUrl}/index`).then((response) => {
            return response;
        });
    }

}