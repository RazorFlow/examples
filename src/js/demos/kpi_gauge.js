rf.StandaloneDashboard(function(db){
    var kpi = new GaugeComponent ();
    kpi.setDimensions (3, 2);
    kpi.setCaption ('# Closed/Total Tickets (24h)');
    kpi.setLimits (0, 93);
    kpi.setValue (33);

    db.addComponent(kpi);
});