import { useState } from 'react';
import { useDispatch, useSelector } from 'react-redux'
import { IpForm } from '@molecules/forms';
import { Modal, Button } from 'semantic-ui-react';
import { Ips, Comments } from '@organisims/ip';

export default function () {
    const dispatch = useDispatch();
    const ipItem = useSelector((state) => state.Ip.item);
    const [open, setOpen] = useState(false);

    const handleClose = () => {
        setOpen(false);
        dispatch({ type: 'CLEAR_IP_ITEM' })
        dispatch({ type: 'CLEAR_COMMENT_ITEMS' })
    }

    return (
        <>
            <div className="mb-4 text-center mt-8">
                <Button basic compact primary onClick={() => setOpen(true)}>Add IP</Button>
            </div>
            
            <Ips onClick={() => setOpen(true)} />

            <Modal
                size='tiny'
                open={open}
                onClose={() => handleClose()}
                scrolling
                closeIcon
            >
                <Modal.Header>IP Details</Modal.Header>
                <Modal.Content>
                    <IpForm />

                    {
                        Object.keys(ipItem).length > 0 ? <Comments /> : ''
                    }
                </Modal.Content>
            </Modal>
        </>
    );
}