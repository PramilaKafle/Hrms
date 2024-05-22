import React from 'react';
import ReactDOM from 'react-dom/client';
import { dataList } from './Data';
import { useState } from 'react';

export function Profile(props) {
    let person = props.person;
    let size = props.size;
    const avatar = "https://i.imgur.com/MK3eW3Am.jpg";
    return (
        <img
            src={avatar}
            alt={person.name}
            width={size}
            height={100}
        />
    );
}

function formatDate(date) {
    return new Intl.DateTimeFormat(
        'en-US',
        { weekday: 'long' }
    ).format(date);
}



export default function Gallery() {
    const [index, setIndex] = useState(0);
    const [showMore, setShowMore] = useState(false);
    const today = new Date();

    function handleNextClick() {
        setIndex(index + 1);
    }
    function handleMoreClick() {
        setShowMore(!showMore);
    }
    let data = dataList[index];
    return (
        <section>
            <button onClick={handleNextClick} className="btn btn-secondary">Next</button>
            <h2>
                <i>{data.name} </i>
                by {data.artist}
            </h2>
            <h3>
                ({index + 1} of {dataList.length})
            </h3>
            <button onClick={handleMoreClick} className="btn btn-secondary">
                {showMore ? 'Hide' : 'Show'} details
            </button>
            {showMore && <p>{data.description}</p>}
            <img
                src={data.url}
                alt={data.alt}
            />
        </section>
    );
}
