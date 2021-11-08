import API from "utils/api";

class CommentService {
    async save( ip_id, comment ) {
        return await API.post(`comment`, { ip_id, comment });
    }
    
    async update( id, comment ) {
        return await API.put(`comment/${id}`, { comment });
    }
}

export default new CommentService();