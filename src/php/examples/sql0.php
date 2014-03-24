<?php

class SampleDashboard extends StandaloneDashboard {
  protected $pdo;
  public function initialize(){
  	$this->pdo = new PDO("sqlite:/home/anirudh/rf/examples/fixtures/databases/Chinook_Sqlite.sqlite");
  }

  private function getTopArtists () {
  	$query = $this->pdo->query("SELECT SUM(Track.UnitPrice * Quantity) AS total_sales, Artist.Name FROM InvoiceLine JOIN Invoice ON Invoice.InvoiceId = InvoiceLine.InvoiceId JOIN Track ON Track.TrackId = InvoiceLine.TrackId JOIN Album ON Track.AlbumId = Album.AlbumId JOIN Artist ON Album.ArtistId = Artist.ArtistId GROUP BY Artist.Name ORDER BY total_sales DESC LIMIT 5;");
  	return  $query->fetchAll(PDO::FETCH_ASSOC);
  }

  private function getTopAlbums($artistName = null) {
  	if($artistName !== null) {
  		$res = $this->pdo->prepare("SELECT SUM(Track.UnitPrice * Quantity) AS total_sales, Album.Title FROM InvoiceLine JOIN Invoice ON Invoice.InvoiceId = InvoiceLine.InvoiceId JOIN Track ON Track.TrackId = InvoiceLine.TrackId JOIN Album ON Track.AlbumId = Album.AlbumId JOIN Artist ON Album.ArtistId = Artist.ArtistId WHERE Artist.Name = :artistName GROUP BY Album.Title ORDER BY total_sales DESC LIMIT 5;");
  		$res->execute(array('artistName' => $artistName));
  	}
  	else {
  		$res = $this->pdo->query("SELECT SUM(Track.UnitPrice * Quantity) AS total_sales, Album.Title FROM InvoiceLine JOIN Invoice ON Invoice.InvoiceId = InvoiceLine.InvoiceId JOIN Track ON Track.TrackId = InvoiceLine.TrackId JOIN Album ON Track.AlbumId = Album.AlbumId JOIN Artist ON Album.ArtistId = Artist.ArtistId GROUP BY Album.Title ORDER BY total_sales DESC LIMIT 5;");
  	}
  	return  $res->fetchAll(PDO::FETCH_ASSOC);
  }

  public function buildDashboard () {
  	$chart = new ChartComponent ('c1');
  	$chart->setDimensions (6, 6);
  	$chart->setCaption ("Top 5 Artists by Revenue");
  	$top_artists = $this->getTopArtists();
  	$chart->setLabels (ArrayUtils::pluck($top_artists, "Name"));
  	$chart->addSeries ('series_1', "Top Artists", ArrayUtils::pluck($top_artists, "total_sales"));
  	$this->addComponent($chart);

  	$topAlbumsChart = new ChartComponent ('c2');
  	$topAlbumsChart->setDimensions (6, 6);
  	$topAlbumsChart->setCaption ("Top 5 Albums by Revenue");
  	$top_albums = $this->getTopAlbums();
  	$topAlbumsChart->setLabels (ArrayUtils::pluck($top_albums, "Title"));
  	$topAlbumsChart->addSeries ('series_1', "Top Albums", ArrayUtils::pluck($top_albums, "total_sales"));
  	$this->addComponent($topAlbumsChart);

    $chart->bindToEvent ("itemClick", array($topAlbumsChart), "handleArtistChartClick");
  }

  public function handleArtistChartClick ($source, $target, $params) {
    $artistName = $params->label;
    $topAlbumsChart = $this->getComponentByID("c2");
    $top_albums = $this->getTopAlbums ($artistName);
    $topAlbumsChart->setCaption ("Top 5 albums by ".$artistName);
    $topAlbumsChart->setLabels (ArrayUtils::pluck($top_albums, "Title"));
    $topAlbumsChart->updateSeries ('series_1', ArrayUtils::pluck($top_albums, "total_sales"));
  }
}

$db = new SampleDashboard();
$db->renderStandalone();
  