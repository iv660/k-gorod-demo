/**
 * Books class represents the books directory.
 */
class Books extends React.Component {
    
    /**
     * Component state varibales.
     * 
     * @type Object
     */
    state;
    
    /**
     * The current page number.
     * 
     * @type integer
     */
    page = 1;
    
    /**
     * The total number of pages.
     * 
     * @type integer
     */
    pageCount = null;
    
    /**
     * Class constructor.
     * 
     * @param {string} props Component parameters.
     * @returns {Books}
     */
    constructor(props) {
        super(props);
        
        this.state = {
            data: {items: []},
            error: '',
        };
        this.loadPageData();
    }
    
    /**
     * Load data for the current page.
     * 
     * @returns {undefined}
     */
    loadPageData() {
        var requestParams = {};
        var apiUrl = new URL(this.props.config.api_url);
        
        apiUrl.searchParams.append('page', this.page);
        
        $.ajax(apiUrl.toString(), requestParams).done((function (data, textStatus, xhr){
            var stateData = this.state.data;
            stateData.items = data;
            this.pageCount = xhr.getResponseHeader('x-pagination-page-count');
            this.setData(stateData);
            this.resetError();
        }).bind(this))
        .fail((function (xhr, textStatus, error) {
            this.setError(error);
        }).bind(this));
    }
    
    /**
     * Sets the state data object.
     * 
     * @param {Object} data
     * @returns {undefined}
     */
    setData (data) {
        this.setState({data: data});
    }
    
    /**
     * Sets the error state.
     * 
     * @param {string} error
     * @returns {undefined}
     */
    setError (error) {
        this.setState({error: error})
    }
    
    /**
     * Clears the error state.
     * 
     * @returns {undefined}
     */
    resetError () {
        this.setError('');
    }
    
    /**
     * Handler for a click on a page select button.
     * 
     * @param {Object} event Event data
     * @returns {undefined}
     */
    changePageHandler (event) {
        
        event.data.container.page = $(event.currentTarget).data('page');
        event.data.container.loadPageData();
    }
    
    /**
     * Render the component content.
     * 
     * @returns string
     */
    render () {
        if (this.state.error !== '') {
            return (<div>Cannot get data from the API: <code>{this.state.error}</code></div>);
        }
        
        return (
            <div>
                <ul>{ this.state.data.items.map((function(m, index){
        
                    return <li>{m.name}</li>;
        
                }).bind(this)) }
                </ul>
                <Pagination page_count={this.pageCount} list_id="pagination-list" page={this.page} />
            </div>
        );
    }
    
    /**
     * Add the event handler as soon as the component is mounted.
     * 
     * @returns {undefined}
     */
    componentDidMount () {
        
        var $this = $(ReactDOM.findDOMNode(this));
        
        $this.on('click', '#pagination-list a', {container: this}, this.changePageHandler);
    }
}

/**
 * The pagination control.
 */
class Pagination extends React.Component {
    
    /**
     * Pagination constructor. 
     * 
     * @param {string} props
     * @returns {Pagination}
     */
    constructor(props) {
        super(props);
    }
    
    /**
     * Builds an array of page dummies.
     * 
     * We need this workaround because we can't use the for loops in a render
     * method.
     */    
    getPagesArray () {
        var pages = [];
        var i;
        for (i = 1; i <= this.props.page_count; i++)  {
            pages.push(i);
        }
        return pages;
    }
    
    render() {
        if (this.props.page_count < 2) {
            return '';
        }
        
        var pages = this.getPagesArray();
        return <ul id={this.props.list_id} className="pagination">
            {pages.map((function (m, index) {
                if (m != this.props.page) {
                    return <li><a href="#" data-page={m}>{m}</a></li>;
                } else {
                return <li className="active"><a href="#" data-page={m}>{m}</a></li>;
                }
            }).bind(this))}
        </ul>;
    }
}

ReactDOM.render(
    <Books config={ booksConfig } />,
    document.getElementById('books-container')
);
