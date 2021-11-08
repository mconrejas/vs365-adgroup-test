export default function ({ ipItems = [], handleClick }) {
    return (
        <Card.Group>
        {
            ipItems.length > 0 ? ipItems.map((item, key) => {
                return (
                    <Card key={key} onClick={(e) => handleClick(item.id)} className="cursor-pointer">
                        <Card.Content>
                            <Card.Header>{ item.ip }</Card.Header>
                            <Card.Meta>
                                <Icon name='time'/> 
                                <Moment fromNow ago>{item.updated_at}</Moment>
                            </Card.Meta>
                            <Card.Description>
                                { item.label }
                            </Card.Description>
                        </Card.Content>
                    </Card>
                );
            }) : ''
        }
        </Card.Group>
    );
}