import LoginForm from "@organisims/LoginForm";

export default () => {
    return (
        <div className='text-center w-1/4 mx-auto py-28'>
            <h1>Login</h1>
            
            <div className="flex p-8 py-20">
                <LoginForm className='flex-grow'/>
            </div>
        </div>
    );
}