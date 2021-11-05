import { useState } from 'react';
import { useDispatch, useSelector } from 'react-redux'
import { update, save } from "@actions/comment";
import { Button, Form, TextArea, Icon } from 'semantic-ui-react'

export function Comment() {
    const dispatch = useDispatch();
    const ipItem = useSelector((state) => state.Ip.item);
    const commentItem = useSelector((state) => state.Comment.item);
    const [comment, setComment] = useState(commentItem?.comment ?? '');
    const [key, setKey] = useState(0);

    const handleSubmit = (e) => {
        e.preventDefault();

        dispatch(Object.keys(commentItem).length > 0 ? update(commentItem.id, comment) : save(ipItem.id, comment))
        .then(e => {
            dispatch({ type: 'CLEAR_COMMENT_ITEM' });
            setComment('');
            setKey(key + 1);
        });
    }

    return (
        <Form className='flex' onSubmit={ e => handleSubmit(e) }>
            <TextArea 
                key={key}
                className='mr-2' 
                rows={1} 
                defaultValue={commentItem?.comment ?? ''} 
                placeholder='Comment' 
                onChange={(e) => setComment(e.target.value)}
            />
            
            <Button compact primary className='flex-none p-4 h-12'>
                <Icon name='send' className='mx-0' />
            </Button>
        </Form>
    );
}