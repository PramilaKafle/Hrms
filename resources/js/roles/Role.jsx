import React, { useState } from 'react';
import { createRoot } from 'react-dom/client';
import axios from 'axios';
import { useEffect } from 'react';

import { Link, useLocation } from 'react-router-dom';


export default function Role() {
    const [roles, setRoles] = useState([]);

    const [success, setSuccess] = useState('');
    const [showSuccess, setShowSuccess] = useState(false);
    const location = useLocation();
    const initialSuccess = location.state?.success;

    var sl = 0;
    useEffect(() => {
        if (initialSuccess) {
            setSuccess(initialSuccess);
            setShowSuccess(true);
            setTimeout(() => {
                setShowSuccess(false);
            }, 2000);
        }
        axios.get(`/api/roles`)
            .then(response => {
                setRoles(response.data.roles);

            })
            .catch(error => {
                console.log('Error fetching data:', error);
            });
    }, [initialSuccess]);

    // deleting role and updating the view
    const deleteRole = (id) => {
        axios.delete(`/api/roles/${id}`)
            .then(response => {
                setRoles(roles.filter(role => role.id !== id));
                setSuccess('Role deleted successfully');
                setShowSuccess(true);
                setTimeout(() => {
                    setShowSuccess(false);
                }, 2000);
            })
            .catch(error => {
                console.log('Error deleting role:', error);
            });
    };
    return (
        <>
            {showSuccess && <div className="alert alert-success ">{success}</div>}
            <div className="card  mb-4">
                <div className="card-header">
                    <div className="row">
                        <div className="col-md-6">
                            <Link className="btn btn-success " to={'/roles/addrole'}>
                                <i className="fa-solid fa-plus" />
                                Add Role
                            </Link>
                        </div>
                        <div className="col-md-6  d-flex justify-content-end"></div>
                    </div>
                </div>
                <div className="card-body">

                    <table className=" table">
                        <thead style={{ background: "#f2f2f2" }}>
                            <tr>
                                <th scope="col" style={{ width: "10%" }}>
                                    SN
                                </th>
                                <th scope="col" style={{ width: "10%" }}>
                                    Name
                                </th>
                                <th scope="col" style={{ width: "10%" }}>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            {roles.map(role => (
                                <tr key={role.id}>
                                    <td>{++sl}</td>
                                    <td>{role.name}</td>
                                    <td>
                                        <div className="d-flex">
                                            <Link
                                                className="btn-sm btn-success btn mx-2"
                                                to={`/roles/${role.id}/edit`}
                                            >
                                                Edit
                                            </Link>
                                            <Link
                                                className="btn-sm btn-primary btn mx-2"
                                                to={`/roles/${role.id}`}
                                            >
                                                View
                                            </Link>

                                            <button className="btn-sm btn-danger btn" onClick={() => deleteRole(role.id)}>
                                                Delete</button>

                                        </div>
                                    </td>
                                </tr>
                            ))}



                        </tbody>
                    </table>


                </div>
            </div>
        </>


    );

}