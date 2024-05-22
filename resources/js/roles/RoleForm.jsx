import React from 'react';
import axios from 'axios';
import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { useNavigate, useParams } from 'react-router-dom';


export default function RoleForm() {


    const [name, setName] = useState([]);
    const [permissions, setPermissions] = useState([]);
    const [selectedPermissions, setSelectedPermissions] = useState([]);
    const navigate = useNavigate();
    const { id } = useParams();
    const [error, setError] = useState('');


    useEffect(() => {
        axios.get(`/api/roles/create`)
            .then(response => {
                console.log(response.data);
                setPermissions(response.data.permissions);
            })
            .catch(error => {
                console.log('Error fetching data:', error);
            });

        // getting roledata  for edit
        if (id) {
            axios.get(`/api/roles/${id}`)
                .then(response => {
                    const role = response.data.role;
                    const permissions = response.data.permissions;
                    setName(role.name);
                    setSelectedPermissions(permissions.map(p => p.id));

                })
                .catch(error => {
                    console.error('Error fetching role:', error);

                });
        }
    }, []);


    const handlePermissionsChange = (e) => {
        const options = e.target.options;
        let selected = [];
        for (let i = 0, l = options.length; i < l; i++) {
            if (options[i].selected) {
                selected.push(options[i].value);
            }
        }
        setSelectedPermissions(selected);
    };


    const handleSubmit = (e) => {
        e.preventDefault();
        const data = { name, permissions: selectedPermissions };
        //console.log(data);


        if (id) {
            // Edit role
            axios.put(`/api/roles/${id}`, data)
                .then(response => {
                    console.log('Role Edited', response.data);
                    navigate('/', { state: { success: 'Role updated sucessfully' } });
                })
                .catch(error => {
                    console.log('Error updating role:', error);
                    const errors = error.response.data.errors.name;
                    setError(errors);
                });
        }
        // Create new role
        else {
            axios.post('/api/roles/store', data)
                .then(response => {
                    console.log('Role created', response.data);
                    navigate('/', { state: { success: 'Role created successfully' } });



                })
                .catch(error => {
                    const errors = error.response.data.errors.name;
                    setError(errors);
                });

        }




    };


    return (
        <div className="main-content mt-4">
            {error && <div className="alert alert-danger fade-out">{error}</div>}
            <div className="card mx-4">
                <div className="card-header">
                    <div className="row">
                        <div className="col-md-6">
                            <h4>{id ? 'Edit Role' : 'Create Role'}</h4>
                        </div>
                        <div className="col-md-6  d-flex justify-content-end">
                            <Link to={'/roles'} className="btn btn-success"> Back</Link>

                        </div>
                    </div>
                </div>
                <div className="card-body ">
                    <form className="form-horizontal " onSubmit={handleSubmit}>

                        <div className="form-group row mb-4">
                            <label className="control-label col-sm-2 " htmlFor="name">Name:</label>
                            <div className="col-sm-5">
                                <input type="text" className="form-control" id="name"
                                    value={name}
                                    onChange={(e) => setName(e.target.value)}
                                />
                            </div>
                        </div>
                        <div className="form-group row mb-4">
                            <label className="control-label col-sm-2 " htmlFor="permission">Permission:</label>
                            <div className="col-sm-5">
                                <select name="permissions[]" id="" className="form-control" multiple value={selectedPermissions} onChange={handlePermissionsChange}>
                                    {permissions.map(permission => (
                                        <option key={permission.id} value={permission.id}>{permission.name}</option>
                                    ))}
                                </select>
                            </div>
                        </div>
                        <div className="form-group row mb-4">
                            <label className="control-label col-sm-2 " htmlFor="name">
                            </label>
                            <div className="col-sm-5  d-flex justify-content-center ">
                                <button className="btn btn-primary"> Add Role</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div >
        </div>

    );

}