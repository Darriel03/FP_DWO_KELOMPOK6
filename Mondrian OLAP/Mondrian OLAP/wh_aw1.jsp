<%@ page session="true" contentType="text/html; charset=ISO-8859-1" %>
<%@ taglib uri="http://www.tonbeller.com/jpivot" prefix="jp" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jstl/core" %>


<jp:mondrianQuery id="query01" jdbcDriver="com.mysql.jdbc.Driver" 
jdbcUrl="jdbc:mysql://localhost/wh_aw?user=root&password=" catalogUri="/WEB-INF/queries/wh_aw1.xml">

select {[Measures].[ProductionQty],[Measures].[Size],[Measures].[Weight],[Measures].[List Price],[Measures].[Actual Cost]} ON COLUMNS,
  {([All Product],[All Times],[Location])} ON ROWS
from [fktpdk]


</jp:mondrianQuery>





<c:set var="title01" scope="session">Query WH ADVENTURE WORKS using Mondrian OLAP</c:set>