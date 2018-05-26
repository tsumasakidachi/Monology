$(function () {
    function TimelinePageViewModel() {
        var self = this;
    
        self.body = ko.observable('');
        self.result = ko.observable('');
        self.messages = ko.observableArray($.parseJSON($('#messages').attr('data-json')));
    
        self.post = function (sender, e) {
            let uri = $(sender).attr('action');
            let data = JSON.stringify({
                'body': self.body()
            });
    
            $.post(uri, data, self.onPost, 'json');
        };

        self.onPost = function (response, status) {
            if (status != 'success') return;

            self.body('');
            self.refresh();
        };
    
        self.refresh = function () {
            let uri = $('#messages').attr('data-uri-selection');
            let data = $.getJSON(uri, self.onRefresh);
        };
    
        self.onRefresh = function (responce, status) {
            if (status != 'success') return;

            self.messages(responce);
        };
    }
    
    ko.applyBindings(TimelinePageViewModel());
});