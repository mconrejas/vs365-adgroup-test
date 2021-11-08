import { useDispatch, useSelector } from 'react-redux'
import { Comment, Header } from 'semantic-ui-react'
import { CommentForm } from '@molecules/forms';
import Moment from 'react-moment';

export function CommentsList() {
    const dispatch = useDispatch();
    const user = useSelector((state) => state.User);
    const ipItem = useSelector((state) => state.Ip.item);
    const commentItem = useSelector((state) => state.Comment.item);
    const comments = useSelector((state) => state.Comment.items);

    return (
        <Comment.Group>
            <Header as='h4' dividing>
                Comments
            </Header>

            {
                comments.length > 0 ? comments.map((comment, key) => (
                    <Comment key={key}>
                        <Comment.Content>
                            <Comment.Author as='a'>{ comment?.user.name }</Comment.Author>
                            <Comment.Metadata>
                                <div><Moment fromNow ago>{comment?.updated_at}</Moment></div>
                            </Comment.Metadata>
                            <Comment.Text>
                                { comment?.comment }
                            </Comment.Text>
                            <Comment.Actions>
                            {
                                comment?.user_id === user?.id ? <Comment.Action onClick={() => dispatch({ type: 'SET_COMMENT_ITEM', payload: comment }) }>Edit</Comment.Action> : ''
                            }
                            </Comment.Actions>
                        </Comment.Content>
                    </Comment>)
                ) 
                :
                'No Comments'
            }
            
            <div className='mt-4'>
                <CommentForm commentItem={commentItem} ipId={ipItem?.ip} />
            </div>
        </Comment.Group>
    );
}