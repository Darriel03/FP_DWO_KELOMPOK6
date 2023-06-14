<%@ page session="true" contentType="text/html; charset=ISO-8859-1" %>
<%@ taglib uri="http://www.tonbeller.com/jpivot" prefix="jp" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jstl/core" %>


<jp:mondrianQuery id="query01" jdbcDriver="com.mysql.jdbc.Driver" 
jdbcUrl="jdbc:mysql://localhost/wh_aw?user=root&password=" catalogUri="/WEB-INF/queries/wh_aw.xml">

select {[Measures].[OrderQty],[Measures].[ReceivedQty],[Measures].[RejectQty],[Measures].[Standart Price],[Measures].[Tax]} ON COLUMNS,
  {([All Product],[All Times],[Shipping Method],[Vendor],[Vendor Address])} ON ROWS
from [fktpbl]


</jp:mondrianQuery>





<c:set var="title01" scope="session">Query WH ADVENTURE WORKS using Mondrian OLAP</c:set>