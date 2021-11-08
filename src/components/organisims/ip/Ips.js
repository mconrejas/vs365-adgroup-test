import { useState, useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { Card, Icon, Pagination } from 'semantic-ui-react';
import { all, get } from "@actions/ip";
import Moment from 'react-moment';

export function IpsList({ onClick }) {
    const dispatch = useDispatch();
    const items = useSelector((state) => state.Ip.items);    
    const [loading, setLoading] = useState(false);
    const [page, setPage] = useState(items?.current_page || 1);
    const [limit, setLimit] = useState(15);

    useEffect(() => {
        fetch( page );
    }, []);

    const fetch = ( page ) => {
        setLoading(true);

        dispatch(all(page, limit))
        .then(() => {
            setLoading(false);
        });
    }

    const handlePageChange = ( page ) => {
        fetch( page );
    }

    const handleClick = (id) => {
        dispatch(get(id));
        onClick();
    }

    return (
        <>            
            {
                loading ? <div className="text-center"><Icon loading color='blue' size='huge' name='circle notch' /></div> : ''
            }
            
            <Card.Group>
                {
                    items.data?.length > 0 ? items.data.sort((a, b) => b.id - a.id).map((item, key) => {
                        return (
                            <Card key={key} onClick={() => handleClick(item.id)} className="cursor-pointer flex-grow">
                                <Card.Content>
                                    <Card.Header>{ item.label }</Card.Header>
                                    <Card.Meta>
                                        <Icon name='time'/> 
                                        <Moment fromNow>{item.updated_at}</Moment>
                                    </Card.Meta>
                                    <Card.Description>
                                        { item.ip }
                                    </Card.Description>
                                </Card.Content>
                            </Card>
                        );
                    }) : <p className='py-48 text-center flex-grow'>No data</p>
                }
            </Card.Group>

            <div className='flex mt-4'>
                <div className='mx-auto'>
                    <Pagination
                        boundaryRange={1}
                        defaultActivePage={page || 1}
                        ellipsisItem={null}
                        firstItem={null}
                        lastItem={null}
                        siblingRange={1}
                        totalPages={items?.last_page ?? 0}
                        onPageChange={(event, data) => handlePageChange(data.activePage)}
                    />
                </div>
            </div>
        </>
    );
}