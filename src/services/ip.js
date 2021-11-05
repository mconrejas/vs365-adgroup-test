import API from "utils/api";

class IPService {
    async all(page, limit) {
        return await API.get(`ip?page=${page}&limit=${limit}`);
    }

    async get( id ) {
        return await API.get(`ip/${id}`);
    }

    async save( ip, label ) {
        return await API.post(`ip`, { ip, label });
    }
    
    async update( id, label ) {
        return await API.put(`ip/${id}`, { label });
    }
}

export default new IPService();