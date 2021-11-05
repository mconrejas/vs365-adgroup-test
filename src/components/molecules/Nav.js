import { useSelector } from "react-redux"
import { useDispatch } from "react-redux";
import { logout } from "@actions/auth";
import Link from "@atoms/Link"

export default function () {
    const dispatch = useDispatch();
    const user = useSelector((state) => state.User);
    
    const handleLogout = () => {
        dispatch(logout())
        .then(() => {
            window.location.href = '/login';
        });
    }

    return (
        <div className='flex py-4 w-1/2 mx-auto'>
            <div className='w-1/2'>
                <ul>
                    <li><Link className='text-xl font-black' text='AD Group Test' url='/' /></li>
                </ul>
            </div>
            <div className='w-1/2 text-right'>
                <ul className='flex flex-row-reverse'>
                    <li><Link text={`Welcome, ${user.name}`} url='#' /></li>
                </ul>
            </div>
        </div>
    )
}