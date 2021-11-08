import { useState } from 'react';
import { useDispatch, useSelector } from 'react-redux'
import { Button, Form, Input } from 'semantic-ui-react'
import { updateIp, saveIp } from "@actions/ip";

export function Ip() {
    const dispatch = useDispatch();
    const obj = useSelector((state) => state.Ip.item);
    const [ip, get] = useState();
    const [label, setLabel] = useState();
    const [loading, setLoading] = useState(false);
    const [edit, setEdit] = useState(false);

    const handleSubmit = (e) => {
        setLoading(true)

        if( Object.keys(obj).length > 0 && label === '' ) {
            alert("Please enter label");
            return false
        }

        dispatch( Object.keys(obj).length > 0 ? updateIp(obj.id, label) : saveIp(ip, label))
        .then(() => setEdit(false));

        setLoading(false);
    }

    return (
        <Form className='flex-row' onSubmit={(e) => e.preventDefault()}>
            <Form.Field>
                <Input type='text' disabled={Object.keys(obj).length > 0} defaultValue={obj?.ip} placeholder='IP' onChange={(e) => get(e.target.value)} />
            </Form.Field>

            <Form.Field>
                <Input type='text' disabled={Object.keys(obj).length > 0 && !edit} defaultValue={obj?.label} placeholder='Label' onChange={(e) => setLabel(e.target.value)} />
            </Form.Field>

            <Form.Field className='text-center'>
                {
                    !edit ? 
                        (
                            Object.keys(obj).length > 0 ?
                                <Button compact color='orange' content='Edit' icon='pencil' labelPosition='right' className='flex-none p-4' onClick={() => setEdit(true)} />
                            :
                                <Button compact primary content='Save' icon='save' labelPosition='right' loading={loading} className='flex-none p-4' onClick={(e) => handleSubmit(e)} />

                        )
                        
                    :
                    <>
                        <Button compact primary content='Save' icon='save' labelPosition='right' loading={loading} className='flex-none p-4' onClick={(e) => handleSubmit(e)} />
                        <Button compact color='grey' content='Cancel' icon='cancel' labelPosition='right' loading={loading} className='flex-none p-4' onClick={() => setEdit(false)} />
                    </>
                }
            </Form.Field>
        </Form>
    );
}