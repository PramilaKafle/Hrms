import React from 'react';
import axios from 'axios';
import { useState, useEffect } from 'react';

function Card(props) {
    return (

        <div className="col-xl-3 col-md-6">
            <div className={props.classname}>
                <div className="card-header align-items-center">{props.header}</div>
                <div className="card-body">
                    <div className=" d-flex align-items-center justify-content-center">
                        <i className={props.icon} />
                        <div className="text-white mx-2" style={{ fontSize: 20 }}>
                            {props.count}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    )
}
export default function Count() {


    const [userCount, setUserCount] = useState(0);
    const [employeeCount, setEmployeeCount] = useState(0);


    // way to connect to the database
    useEffect(() => {
        axios.get('/api/count')
            .then(response => {
                setUserCount(response.data.userCount);
                setEmployeeCount(response.data.employeeCount);
            })
            .catch(error => {

                console.log('Error fetching user count:', error);
            });
    }, []);
    return (
        <>
            <div className="row">
                <Card header={'Total Users'}
                    classname={'card bg-primary text-white mb-4'}
                    icon={'fa-regular fa-user fa-lg mr-2'}
                    count={userCount}
                />
                <Card header={'Employees'}
                    classname={'card bg-success text-white mb-4'}
                    icon={'fa-regular fa-user fa-lg mr-2'}
                    count={employeeCount} />
            </div >

        </>


    );
}