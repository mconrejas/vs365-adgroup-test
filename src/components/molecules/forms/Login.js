import { useState } from 'react';
import { useHistory } from "react-router-dom";
import { useDispatch } from "react-redux";
import { login } from "@actions/auth";
import { setUser } from "@actions/user";
import { Button, Form, Input } from 'semantic-ui-react'


export function Login() {
    const history = useHistory();
    const dispatch = useDispatch();
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [isLoading, setIsLoading] = useState(false);

    const handleSubmit = async (e) => {
        e.preventDefault();

        setIsLoading(true);

        dispatch(login(email, password))
        .then(() => {
            dispatch(setUser())
            .then(() => window.location.href = '/');
        });

        setIsLoading(false);
    }

    return (
        <Form
            onSubmit={ (e) => handleSubmit(e) }
            className='flex-grow'
        >
            <Form.Field>
                <Input
                    type="email"
                    placeholder="Email"
                    onChange={ (e) => setEmail(e.target.value) }
                />
            </Form.Field>
            
            <Form.Field>
                <Input 
                    type="password"
                    placeholder="Password"
                    onChange={ (e) => setPassword(e.target.value) }
                />
            </Form.Field>

            <Button loading={isLoading} primary>
                Login
            </Button>
        </Form>
    );
}