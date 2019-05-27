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
        };
//        this.setState({data: {items: props.items}}),
        this.loadPageData();
//        this.handleChange = this.handleChange.bind(this);
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
        console.log(apiUrl);
        
        $.ajax(apiUrl.toString(), requestParams).done((function (data, textStatus, xhr){
            var stateData = this.state.data;
            console.log(data);
            stateData.items = data;
            this.setState({data: stateData});
        }).bind(this));
    }
    
    changePageHandler (event) {
        console.log('changePageHandler()');
        console.log(event);
        
        event.data.container.page = $(event.currentTarget).data('page');
        event.data.container.loadPageData();
    }
    
    /**
     * Render the component content.
     * 
     * @returns string
     */
    render () {
        return (
            <div>
                <ul>{ this.state.data.items.map((function(m, index){
        
                    return <li>{m.name}</li>;
        
                }).bind(this)) }
                </ul>
                <Pagination page_count="7" list_id="pagination-list" page={this.page} />
            </div>
        );
    }
    
    /**
     * 
     * @returns {undefined}
     */
    componentDidMount () {
        console.log('Mount complete.');
        
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
        console.log('getPagesArray()');
        console.log('Pages: ' + this.props.page_count);
        var i;
        for (i = 1; i <= this.props.page_count; i++)  {
            console.log('Pushing ' + i);
            pages.push(i);
            console.log(pages);
        }
        return pages;
    }
    
    render() {
        if (this.props.page_count > 0) {
            var pages = this.getPagesArray();
            console.log(pages);
            return <ul id={this.props.list_id}>
                {pages.map((function (m, index) {
                    if (m != this.props.page) {
                        return <li><a href="#" data-page={m}>{m}</a></li>;
                    } else {
                    return <li><span className="current_page">{m}</span></li>;
                    }
                }).bind(this))}
            </ul>;
        }
    }
}

ReactDOM.render(
    <Books config={ {'api_url': 'https://php7.docwriter.ru/k-gorod/api/web/api/v1/books?per-page=2'} } />,
    document.getElementById('books-container')
);
