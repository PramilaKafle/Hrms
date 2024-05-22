import React from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';
import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
export default function RoleView() {
    const { id } = useParams();
    const [role, setRole] = useState([]);
    const [permissions, setPermission] = useState([]);

    useEffect(() => {
        axios.get(`/api/roles/${id}`)
            .then(response => {
                //console.log(response.data);
                setRole(response.data.role);
                setPermission(response.data.permissions);
            })
            .catch(error => {
                console.log('Error fetching role:', error);
            });
    }, [id]);
    if (!role) {
        return <div>Loading...</div>;
    }
    return (
        <div className="main-content mt-4">
            <div className="card mx-6">
                <div className="card-header">
                    <div className="row">
                        <div className="col">
                            <h4>Role Information</h4>
                        </div>
                        <div className="col d-flex justify-content-end">
                            <Link className="btn btn-success mx-1" to={`/roles`}>
                                Back
                            </Link>
                        </div>
                    </div>
                </div>
                <div className="card-body">
                    <table className="d-flex justify-content-center">
                        <tbody>
                            <tr>
                                <td style={{ padding: 20 }}>Name:</td>
                                <td>{role.name}</td>

                            </tr>
                            <tr>
                                <td style={{ padding: 20 }}>Permissions:</td>
                                {permissions.map((permission, index) => (
                                    <td key={index}> {permission.name}
                                        {index < permissions.length - 1 && ','}
                                    </td>
                                ))}

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    );
}