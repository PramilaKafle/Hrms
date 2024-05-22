import React from 'react';
import { createRoot } from 'react-dom/client';
import axios from 'axios';
import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';

export default function UserList() {
    const [users, setUsers] = useState([]);

    useEffect(() => {
        axios.get('/api/count')
            .then(response => {
                setUsers(response.data.users);
            })
            .catch(error => {
                console.log('Error fetching user count:', error);
            });
    }, []);

    return (
        <>
            <div className="dropdown">
                <button
                    className="btn btn-secondary dropdown-toggle mt-3"
                    type="button"
                    id="dropdownMenuButton1"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    Dropdown button
                </button>
                <ul className="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    {users.map(user => (
                        <li key={user.id}>
                            <Link to={`/users/${user.id}`} className="dropdown-item">
                                {user.name}
                            </Link>
                        </li>
                    ))}
                </ul>
            </div>

        </>
    );
}

