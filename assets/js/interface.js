( function($) {
  'use strict';
$(function(e) {

/*------------------------------------------------------------------
	back to top
	-------------------------------------------------------------------*/
 var top = $('#back-top');
	top .hide();
	 
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				top .fadeIn();
			} else {
				top .fadeOut();
			}
		});
		$('#back-top a').on('click', function(e) {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
});


})(jQuery);

function checkDate()
{
	if(document.sewa.todate.value < document.sewa.fromdate.value){
			alert("Tanggal selesai harus lebih besar dari tanggal mulai sewa!");
			return false;
	}
	if(document.sewa.fromdate.value < document.sewa.now.value){
		alert("Tanggal sewa minimal H-1!");
		return false;
	}
	return true;

	
}

document.addEventListener('DOMContentLoaded', function() {
  const btnLeft = document.querySelector('.btn-left');
  const btnRight = document.querySelector('.btn-right');
  const fromDateInput = document.querySelector('input[name="fromdate"]');
  const toDateInput = document.querySelector('input[name="todate"]');
  const now = new Date();
  const roomsPerPage = 10;
  let currentPage = 1;

  function addDays(date, days) {
    const result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
  }

  function formatDate(date) {
    const d = new Date(date);
    let month = '' + (d.getMonth() + 1);
    let day = '' + d.getDate();
    const year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
  }

  function setDefaultDates() {
    const tomorrow = addDays(now, 1);
    fromDateInput.value = formatDate(tomorrow);
    toDateInput.value = formatDate(addDays(tomorrow, 30));
  }

  function updateToDate(days) {
    const fromDate = new Date(fromDateInput.value);
    const toDate = new Date(toDateInput.value);
    if (toDateInput.value === "") {
      toDateInput.value = formatDate(addDays(fromDate, days));
    } else {
      toDateInput.value = formatDate(addDays(toDate, days));
    }
  }

  btnLeft.addEventListener('click', function(event) {
    event.preventDefault();
    if (!fromDateInput.value) {
      setDefaultDates();
    } else {
      updateToDate(-30);
    }
  });

  btnRight.addEventListener('click', function(event) {
    event.preventDefault();
    if (!fromDateInput.value) {
      setDefaultDates();
    } else {
      updateToDate(30);
    }
  });

  fromDateInput.addEventListener('change', function() {
    const fromDate = new Date(fromDateInput.value);
    toDateInput.value = formatDate(addDays(fromDate, 30));
  });

  // Filter and Pagination Logic
  const searchNamaKost = document.getElementById('searchNamaKost');
  const searchKamarMandi = document.getElementById('searchKamarMandi');
  const searchAC = document.getElementById('searchAC');
  const searchTipeKost = document.getElementById('searchTipeKost');
  const availableRoomsCount = document.getElementById('availableRoomsCount');
  const productListing = document.querySelectorAll('.product-listing-m');
  const btnNext = document.querySelector('.btn-next');
  const btnPrev = document.querySelector('.btn-prev');

  function filterRooms() {
    let filteredRooms = Array.from(productListing);
    const namaKost = searchNamaKost.value.toLowerCase();
    const kamarMandi = searchKamarMandi.value.toLowerCase();
    const ac = searchAC.value.toLowerCase();
    const tipeKost = searchTipeKost.value.toLowerCase();

    if (namaKost) {
      filteredRooms = filteredRooms.filter(room => room.querySelector('h5 a').textContent.toLowerCase().includes(namaKost));
    }
    if (kamarMandi) {
      filteredRooms = filteredRooms.filter(room => room.querySelector('li:nth-child(2)').textContent.toLowerCase().includes(kamarMandi));
    }
    if (ac) {
      filteredRooms = filteredRooms.filter(room => {
        const acText = room.querySelector('li:nth-child(3)').textContent.trim().toLowerCase();
        return ac === 'ada' ? acText === 'ada' : acText === 'tidak ada';
      });
    }
    if (tipeKost) {
      filteredRooms = filteredRooms.filter(room => room.querySelector('h5 a').textContent.toLowerCase().includes(tipeKost));
    }

    availableRoomsCount.textContent = `${filteredRooms.length} Kamar Kost Tersedia`;
    displayRooms(filteredRooms, currentPage);
  }

  function displayRooms(rooms, page) {
    productListing.forEach(room => room.style.display = 'none');
    const start = (page - 1) * roomsPerPage;
    const end = start + roomsPerPage;
    rooms.slice(start, end).forEach(room => room.style.display = 'block');
    btnPrev.style.display = page > 1 ? 'inline-block' : 'none';
    btnNext.style.display = end < rooms.length ? 'inline-block' : 'none';
    scrollToTop();
  }

  function scrollToTop() {
    const listingPage = document.querySelector('.listing-page');
    listingPage.scrollIntoView({ behavior: 'smooth' });
  }

  searchNamaKost.addEventListener('change', filterRooms);
  searchKamarMandi.addEventListener('change', filterRooms);
  searchAC.addEventListener('change', filterRooms);
  searchTipeKost.addEventListener('change', filterRooms);

  btnNext.addEventListener('click', function() {
    currentPage++;
    filterRooms();
  });

  btnPrev.addEventListener('click', function() {
    currentPage--;
    filterRooms();
  });

  filterRooms(); // Initial call to display rooms
});

const searchForm = document.querySelector('form[name="sewa"]');
const fromDateInput = document.querySelector('input[name="fromdate"]');
const toDateInput = document.querySelector('input[name="todate"]');
const dateRangeSpan = document.getElementById('dateRange');

searchForm.addEventListener('submit', function(event) {
  const fromDate = fromDateInput.value;
  const toDate = toDateInput.value;

  if (fromDate && toDate) {
    const fromDateFormatted = new Date(fromDate).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
    const toDateFormatted = new Date(toDate).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });

    dateRangeSpan.textContent = ` pada tanggal ${fromDateFormatted} hingga ${toDateFormatted}`;
    dateRangeSpan.style.display = 'inline';
  }
});