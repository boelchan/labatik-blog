/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package jaspersimpleserver;

import java.io.File;
import java.io.FileInputStream;
import java.io.OutputStream;
import java.lang.reflect.Constructor;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import java.util.StringTokenizer;
import java.util.logging.Level;
import java.util.logging.Logger;
import net.sf.jasperreports.engine.JRException;
import net.sf.jasperreports.engine.JRExporterParameter;
import net.sf.jasperreports.engine.JRParameter;
import net.sf.jasperreports.engine.JasperCompileManager;
import net.sf.jasperreports.engine.JasperExportManager;
import net.sf.jasperreports.engine.JasperFillManager;
import net.sf.jasperreports.engine.JasperPrint;
import net.sf.jasperreports.engine.JasperPrintManager;
import net.sf.jasperreports.engine.JasperReport;
import net.sf.jasperreports.engine.JasperRunManager;
import net.sf.jasperreports.engine.export.JExcelApiExporter;
import net.sf.jasperreports.engine.export.JRCsvExporter;
import net.sf.jasperreports.engine.export.JRHtmlExporter;
import net.sf.jasperreports.engine.export.JRHtmlExporterParameter;
import net.sf.jasperreports.engine.export.JRRtfExporter;
import net.sf.jasperreports.engine.export.JRXlsExporter;
import net.sf.jasperreports.engine.export.JRXlsExporterParameter;
import net.sf.jasperreports.engine.export.oasis.JROdtExporter;
import net.sf.jasperreports.engine.util.JRLoader;

/**
 *
 * @author agung
 */
public class ReportGenerator {

    public static final int FORMAT_UNKNOWN = 0;
    public static final int PDF_FILE    = 1;
    public static final int PDF_STREAM  = 2;
    public static final int HTML_STREAM = 3;
    public static final int HTML_FILE   = 4;
    
    static HashMap m_FormatLookup = new HashMap();
    static {
        m_FormatLookup.put("PDF-FILE",    new Integer(PDF_FILE));
        m_FormatLookup.put("PDF-STREAM",  new Integer(PDF_STREAM));
        m_FormatLookup.put("HTML-STREAM", new Integer(HTML_STREAM));
        m_FormatLookup.put("HTML-FILE",   new Integer(HTML_FILE));
    }
    
    public static int getFormatID(String formatName) {
        Integer id = (Integer)m_FormatLookup.get(formatName);
        if(id==null) return FORMAT_UNKNOWN;
        return id.intValue();
    }

    public static void bootStrap() {
        try {
            Map parameters = new HashMap();
            JasperRunManager.runReportToPdfFile("BootStrap.jasper", "BootStrap.pdf", parameters);
            if(Main.g_fTrace) System.out.println("Jasper Report Bootstrap...");
        } catch (JRException e) {
            e.printStackTrace();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
    
    public byte[] run(String jasperBase, int iJasperTarget, String params, Object out) {
        try {
            {
                //Preparing parameters
                Map parameters = generateParameters(jasperBase, params);
                
                String jasperFile = Main.g_Config.getString("jasper.dir") + "/" + jasperBase + ".jasper";
                File fJasper = new File(jasperFile);
                if(!fJasper.exists()) { // Try to compile from jrxml file
                    String jrxmlFile = Main.g_Config.getString("jasper.dir") + "/" + jasperBase + ".jrxml";
                    File fJrxml = new File(jrxmlFile);
                    if(!fJrxml.exists()) return "<FAIL>".getBytes();
                    JasperCompileManager.compileReportToFile(jrxmlFile, jasperFile);
                }
                if(Main.g_fTrace) System.out.println("Using File: " + jasperFile);                

                switch (iJasperTarget) {
                    case PDF_FILE:
                    {
                        String outFilePath = Main.g_Config.getString("out.dir") + "/" + (String)out;
                        JasperRunManager.runReportToPdfFile(jasperFile, outFilePath, parameters, getConnection());
                        return outFilePath.getBytes();
                    }
                    case HTML_FILE:
                    {
                        String outFilePath = Main.g_Config.getString("out.dir") + "/" + (String)out;
                        JasperRunManager.runReportToHtmlFile(jasperFile, outFilePath, parameters, getConnection());
                        return outFilePath.getBytes();
                    }
                    case PDF_STREAM:
                    {                        
                        return JasperRunManager.runReportToPdf(jasperFile, parameters, getConnection());
                        //return new String(pdfBytes);
                    }
                    case HTML_STREAM:
                    {
		        File sourceFile = new File(jasperFile);
 		        JasperReport jasperReport = (JasperReport)JRLoader.loadObject(sourceFile);
                        JasperPrint  jasperPrint  = JasperFillManager.fillReport(jasperReport, parameters, getConnection());
                        
                        StringBuffer htmlBuffer = new StringBuffer();
                        JRHtmlExporter jHtmlExp = new JRHtmlExporter();
                        jHtmlExp.setParameter(JRHtmlExporterParameter.JASPER_PRINT, jasperPrint);
                        jHtmlExp.setParameter(JRHtmlExporterParameter.OUTPUT_STRING_BUFFER, htmlBuffer);
                        jHtmlExp.exportReport();
                        
                        //return JasperRunManager.runReportToHtmlFile(jasperFile, parameters, getConnection()).getBytes();
                        //return new String(pdfBytes);
                        return htmlBuffer.toString().getBytes();
                    }
                }
                //System.err.println("PDF running time : " + (System.currentTimeMillis() - start));
                
            }
        } catch (JRException e) {
            e.printStackTrace();
        } catch (Exception e) {
            e.printStackTrace();
        }
        
        return "<FAIL>".getBytes();
    }

    private Map generateParameters(String jasperBase, String params) {
        Map parameters = new HashMap();
        ReportParamMapper rpm = ReportParamMapperManager.getMapper(jasperBase);

        StringTokenizer st = new StringTokenizer(params, "&");
        while(st.hasMoreTokens()) {
            String paramPair = st.nextToken();
            StringTokenizer st2 = new StringTokenizer(paramPair, "=");
            try {
                String key = st2.nextToken();
                String val = st2.nextToken();

                if(rpm!=null) rpm.mapParams(parameters, key, val);
                else parameters.put(key, val);
                
            } catch(Exception e) {}
        }
        
        return parameters;
    }
    
    private Connection getConnection() throws ClassNotFoundException, SQLException {

        String driver = Main.g_Config.getString("db.driver");
        String connectString = Main.g_Config.getString("db.connect");
        String user = Main.g_Config.getString("db.user");
        String password = Main.g_Config.getString("db.password");

        Class.forName(driver);
        Connection conn = DriverManager.getConnection(connectString, user, password);
        return conn;
    }
}
