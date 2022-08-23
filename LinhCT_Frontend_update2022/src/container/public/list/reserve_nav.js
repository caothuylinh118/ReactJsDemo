import React, { Component } from 'react';

class ReserveNav extends Component {
    constructor(props) {
        super(props);
        this.state = {
           
        }
        this.props = props;
    }
    

    render() {
        
        return ( 
            <div>
                <section className="reserve_nav">
                <ul className="container">
                    <li className={"reserve_nav_step step01 " + this.props.classStep1}>
                        <span className="hcOmce">1</span>
                        <p className="hyquEa">
                            Information
                        </p>
                    </li>
                    <li className={"reserve_nav_step step02 " + this.props.classStep2}>
                        <span className="hcOmce">2</span>
                        <p className="sc-fzpjYC hyquEa">
                            Confirm
                        </p>
                    </li>
                    <li className={"reserve_nav_step step03 " + this.props.classStep3}>
                        <span className="hcOmce"><i className="fas fa-check"></i></span>
                        <p className="hyquEa">
                            Finished
                        </p>
                    </li>
                </ul>
            </section>
            </div>        
        );
    }
}
export default ReserveNav;