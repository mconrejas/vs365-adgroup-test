import React from "react";
import IP from "@templates/Ip";
import Nav from '@molecules/Nav'

export default function Dashboard() {
    return (
        <>
            <div className='bg-blue-600 '>
                <Nav />
            </div>
            

            <div className="w-1/2 mx-auto">
                <IP />
            </div>
        </>
    );
}